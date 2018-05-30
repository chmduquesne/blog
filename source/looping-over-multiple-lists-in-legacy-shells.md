Title: Looping simultaneously over multiple lists in legacy shells
Date: 2018-05-30 23:11
Category: howto
Tags: shell, sh, dash, ash

I was recently confronted to the problem of looping over multiple lists
simultaneously in a legacy shell, and coming up with an elegant solution
was an interesting challenge. Legacy shells do not support arrays, which
means there is no structure you can directly address with an index i in
order to get the iᵗʰ element. How can one then process multiple lists
simultaneously in order to get the first element of each list, then the
second element of each list, then the third... and so on?

A python analogy
----------------

In python, there is a neat buitin called `zip`. Essentially, `zip` takes an
arbitrary set of lists as an argument, and returns an iterator of tuples,
such that the first tuple is composed of the first element of each list,
the second tuple has the second element of each list, and so on. It always
goes better with an example:

    >>> for t in zip(['a', 'b', 'c', 'd'], [1, 2, 3, 4], ['!', '@', '#', '%']):
    ...     print(t)
    ...
    ('a', 1, '!')
    ('b', 2, '@')
    ('c', 3, '#')
    ('d', 4, '%')

The question is, how can we produce a similar function in a legacy shell?

Let's specify
-------------

Our goal is to produce a shell function that we will also conveniently
name `zip`. Of course, this function must work in legacy shells such as
ash or dash. It will expect an unspecified number of lists as arguments,
and return a flattened list of tuples, where the iᵗʰ tuple is composed of
all of the iᵗʰ elements of each list. Like in python, if the lists
provided as arguments are not of equal lengths, the result will be cut at
the shortest length. Here are examples of expected behaviour:

    # 3 lists of same length
    $ zip "a b c d" "1 2 3 4" "! @ # %"
     a 1 !
     b 2 @
     c 3 #
     d 4 %

    # 1 list
    $ zip "a b c d"
     a
     b
     c
     d

    # 2 lists of different length
    $ zip "a b" "1 2 3"
     a 1
     b 2

    # 0 list
    $ zip

How to use it would then just be a matter of using the set builtin:

    $ list1="1 2 3 4"
    $ list2="a b c d"
    $ set $(zip "$list1" "$list2")
    $ for i in $(seq 1 4); do \
        echo "processing $1 and $2"; \
        shift 2; \
    done
    processing 1 and a
    processing 2 and b
    processing 3 and c
    processing 4 and d

The implementation
------------------

It is often not obvious to the beginner how to create variable names out
of other variables. For example, the name `list$i` is an illegal variable
name, so you cannot do:

    i=1
    list$i="a b c"

What is the way to get around that? The answer is `eval`, of course!

    i=1
    eval "list$i='a b c'"

So our zip function begins like this

    zip(){
        nlists=$#
        for i in $(seq 1 $nlists); do
            eval "list$i='$1'"
            shift
        done
        # the input lists are now in the variable named list1, list2....
        [...]
    }

We would like to loop over all lists, extract the first element, append it
to the tuple, and update the list to reflect the tail. The least error
prone way I have found to extract the first element is to use a printf
construct

    $ printf "%s\n" a b c d
    a
    b
    c
    d

This prints all element of the list line by line. One can easily combine
it with `head -n1` and `tail -n+2` to get the head or the tail of the
list.

    head=$(printf '%s\n' $list | head -n1)
    tail=$(printf '%s\n' $list | tail -n+2)

It works more reliably, for example, than using the buitin `set` to put the
elements of the list in the argument list `$1`, `$2`

    set $list
    head=$1
    shift
    tail="$*"

Why? The reason is that if the first argument is the string litteral `-`, set
will not behave the way we want! The second part of the function therefore
looks like this, with a bunch of `eval`s

    while true; do
        tuple=""
        for i in $(seq 1 $nlists); do
            eval "[ -z \"\$list$i\" ] && return 0"
            eval "head=\$(printf '%s\\n' \$list$i | head -n1)"
            eval "list$i=\$(printf '%s\\n' \$list$i | tail -n+2)"
            tuple="$tuple $head"
        done
        echo "$tuple"
    done

This looks about right: when one of the lists is empty, we know we will
not be able to complete the current tuple, so we return immediately
without further `echo`ing. The devil is in the details, because if
provided with zero argument, this function will loop forever. However, we
really want to start looping if and only if there are arguments. This
could be achieved by changing

    while true; do

to

    while [ $nlists != 0 ]; do

I don't find this construct very readable, as it makes it look like this
condition could change during the loops. I'd rather add the check

    [ $nlist = 0 ] && return 0

at the beginning of the function.

The result
----------

Here is how the code looks at the end. I think this could be a fun
interview question!

    zip(){
        nlists=$#
        [ $nlists = 0 ] && return 0
        for i in $(seq 1 $nlists); do
            eval "list$i='$1'"
            shift
        done
        while true; do
            tuple=""
            for i in $(seq 1 $nlists); do
                eval "[ -z \"\$list$i\" ] && return 0"
                eval "head=\$(printf '%s\\n' \$list$i | head -n1)"
                eval "list$i=\$(printf '%s\\n' \$list$i | tail -n+2)"
                tuple="$tuple $head"
            done
            echo "$tuple"
        done
    }

Do you think it can be improved? Do you have your own different technique
to achieve this? Let me know in the comments!

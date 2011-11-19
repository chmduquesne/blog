Title: Operations Research and Beer drinking
Category: misc
Date: 2011-11-19 17:06

I am just returning from Charlotte NC, where I had an amazing time at the
INFORMS 2011 conference. Being in the airport waiting for my flight, I
figured out I could use this spare time to share a cool story about
Operations Research.

I happen to be a beer lover. If you're anything like me, you probably know
Belgium produces among the best beers in the world. You also probably know
about the [trappist beers][1], which are some of the most famous and
tastiest beers brewed in the area.

Two years ago, [one of my friends][2] had a crazy idea: He looked at a
map, locating the trappist abbeys producing those excellent beers, and
noticed they all were not very far from each other. He thus proposed a
tour of Belgium that would visit all of them, by bicycle. I was
immediately very enthusiastic about the idea and started to think about
how to make it become true.

Planning the trip
-----------------

So, given 7 cities and a tour to plan (The french abbey of [Mont des
Cats][4] and the german abbey of [Maria Toevlucht][5] had not announced
their plans of brewing their own beers at the time), can you guess what am
I immediately thought about? That's right, the [Travelling Salesman
Problem][3]! Of course, the problem itself is NP-hard, but in practice,
with an instance of this size, it is doable manually.

I could have done it by myself, but this was a unique opportunity to use
[the online solver][6] from the [TSP website][7] of the university of
Georgia Tech! Since we did not actually needed to go back to the first
abbey, I removed the longest edge.

I know what you are thinking: "Are you kidding me? A TSP Problem? If you
remove an edge, this is not a tour, this is an Hamiltonian Path!". You are
completely right, I did not solve the right problem. The thing is, I did
not know any Online Hamiltonian Path Solver at the time, and this was
probably the coolest use I could ever make of Concorde. Still a good
story, isn't it?

Doing it!
---------

Here is the trip as we planned it:

<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=d&amp;source=s_d&amp;saddr=Chimay+%4050.048397,4.311786&amp;daddr=Orval,+Florenville,+Belgique+to:Rochefort,+Belgique+to:Achel,+Hamont,+Belgique+to:Koningshoeven,+5018+Tilburg,+Pays-Bas+to:Westmalle,+Royaume+de+Belgique+to:Westvleteren,+Vleteren,+Belgique&amp;hl=fr&amp;geocode=FY2t-wId6spBAA%3BFdpj9QIde5ZRACkjJ_77zo3qRzFW8laZ9FhaqQ%3BFRNr_QIdk6hPACljFprIRsnBRzEgb00vq5kABA%3BFREaDgMd-JhTACEenFGS3R3vUg%3BFWedEgMda_5NACkzdA2EwL_GRzFeLGHzqkBolg%3BFRq7DgMdVpRHACnVxaCIOgDERzECXL1iQqISzg%3BFdwXCQMdSHUpACmNKhq7IsHcRzGWOA_eggi1yQ&amp;sll=50.513427,4.65271&amp;sspn=2.109882,4.916382&amp;vpsrc=0&amp;dirflg=w&amp;mra=ltm&amp;ie=UTF8&amp;ll=50.513427,4.65271&amp;spn=1.93717,2.76712&amp;t=h&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=d&amp;source=embed&amp;saddr=Chimay+%4050.048397,4.311786&amp;daddr=Orval,+Florenville,+Belgique+to:Rochefort,+Belgique+to:Achel,+Hamont,+Belgique+to:Koningshoeven,+5018+Tilburg,+Pays-Bas+to:Westmalle,+Royaume+de+Belgique+to:Westvleteren,+Vleteren,+Belgique&amp;hl=fr&amp;geocode=FY2t-wId6spBAA%3BFdpj9QIde5ZRACkjJ_77zo3qRzFW8laZ9FhaqQ%3BFRNr_QIdk6hPACljFprIRsnBRzEgb00vq5kABA%3BFREaDgMd-JhTACEenFGS3R3vUg%3BFWedEgMda_5NACkzdA2EwL_GRzFeLGHzqkBolg%3BFRq7DgMdVpRHACnVxaCIOgDERzECXL1iQqISzg%3BFdwXCQMdSHUpACmNKhq7IsHcRzGWOA_eggi1yQ&amp;sll=50.513427,4.65271&amp;sspn=2.109882,4.916382&amp;vpsrc=0&amp;dirflg=w&amp;mra=ltm&amp;ie=UTF8&amp;ll=50.513427,4.65271&amp;spn=1.93717,2.76712&amp;t=h" style="color:#0000FF;text-align:left">Show a bigger version</a></small>

We ended up being two (me and my flatmate of the time - Mickael could not
make it) with train tickets to Belgium. Cool facts about this trip:

- We discussed with "le grand maître de [la confrérie de la grusalle et de
  la trappiste de Rochefort][14]".

![grand_maitre_rochefort.jpg](images/grand_maitre_rochefort.jpg)

- We drank some "petit orval", a beer that you can find only at the abbey
  and at the bar ([l'auberge de l'Ange Gardien][13]) and we learned about
  the [legend of Orval][12].
- The lady at the little shop in front of the abbey of Koningshoven (the
  one that brews [la Trappe][8]) was so amazed of what we were doing that
  she gave us a pack of 4 different flavors of Trappes which we brought
  back to France.
- In Gent, there is a barber which is called [bar-bier][12], who (I
  believe) serves bier while shaving the clients.

![gent_barbier.jpg](images/gent_barbier.jpg)

- Gent and Antwerpen are two of the most beautiful cities I have ever
  seen.

The only sad thing about this trip is that we could not get to drink any
Westvleteren : it is actually [quite hard to get some][9], given the fact
the monks over there have chosen to only produce as much beer as needed to
finance the community: when we arrived, they did not have any beer left.

Conclusion
----------

Three months ago, one of my best friends had the opportunity to get some
Westvleteren and he invited me to taste them, offering me the opportunity
to "finish my trip". For the record, the Westvleteren 12 is ranked the
best beer in the world by [ratebeer.com][10]. Needless to say, I enjoyed
it very much. He let me keep the capsules as a souvenir:

![westvleteren.jpg](images/westvleteren.jpg)

[![Our actual map during the trip](images/belgium_trip.resized.jpg "Our
actual map during the trip")][11]

[1]: http://en.wikipedia.org/wiki/Trappist_beer
[2]: http://mickaelistria.wordpress.com/
[3]: http://en.wikipedia.org/wiki/Travelling_salesman_problem
[4]: http://fr.wikipedia.org/wiki/Abbaye_du_Mont_des_Cats
[5]: http://trappist-beers.com/8th-trappist-beer-not-from-mont-des-cats-france-but-from-abbey-zundert-netherlands/
[6]: http://www.tsp.gatech.edu/maps/index.html
[7]: http://www.tsp.gatech.edu/index.html
[8]: http://fr.wikipedia.org/wiki/La_Trappe
[9]: http://en.wikipedia.org/wiki/Westvleteren_Brewery#Availability
[10]: http://www.ratebeer.com/
[11]: images/belgium_trip.jpg
[12]: http://en.wikipedia.org/wiki/Orval_Abbey#The_legend_of_Orval
[13]: http://www.orval.be/fr/accueil/auberge.html
[14]: http://www.confreries.be/conf/grusalle/index.htm

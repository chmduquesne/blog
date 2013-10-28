CONFFILE=pelican.conf.py
INPUTDIR=source
OUTPUTDIR=blog.chmd.fr

all: clean $(OUTPUTDIR)/index.html
	@echo done

$(OUTPUTDIR)/%.html:
	pelican -v -o $(OUTPUTDIR) -s $(CONFFILE) $(INPUTDIR)

clean:
	rm -rf $(OUTPUTDIR)

upload:
	rsync -avz --delete --progress --bwlimit=56 ./blog.chmd.fr/ www@chmd.fr:sites/chmd.fr/blog

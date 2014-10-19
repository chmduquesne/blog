CONFFILE=pelican.conf.py
INPUTDIR=source
OUTPUTDIR=blog.chmd.fr

all: clean $(OUTPUTDIR)/index.html
	cp update.php $(OUTPUTDIR)
	@echo done

$(OUTPUTDIR)/%.html:
	pelican -v -o $(OUTPUTDIR) -s $(CONFFILE) $(INPUTDIR)

clean:
	rm -rf $(OUTPUTDIR)

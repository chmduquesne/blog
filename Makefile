CONFFILE=pelican.conf.py
INPUTDIR=source
OUTPUTDIR=html

all: clean $(OUTPUTDIR)/index.html
	@echo done

$(OUTPUTDIR)/%.html:
	pelican -v -o $(OUTPUTDIR) -s $(CONFFILE) $(INPUTDIR)

clean:
	rm -rf $(OUTPUTDIR)

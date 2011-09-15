CONFFILE=pelican.conf.py
INPUTDIR=articles
OUTPUTDIR=blog

all: $(OUTPUTDIR)/index.html
	@echo done

$(OUTPUTDIR)/%.html:
	pelican $(INPUTDIR) -v -o $(OUTPUTDIR) -s $(CONFFILE)

upload:
	vaporfile -v upload blog.chmd.fr

clean:
	rm -rf $(OUTPUTDIR)

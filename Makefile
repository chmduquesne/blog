CONFFILE=pelican.conf.py
INPUTDIR=articles
OUTPUTDIR=blog
TARGETDIR=/blog
USER=chm.duquesne
HOST=ftpperso.free.fr

all: $(OUTPUTDIR)/index.html
	@echo done

$(OUTPUTDIR)/%.html:
	pelican $(INPUTDIR) -v -o $(OUTPUTDIR) -s $(CONFFILE)

upload:
	lftp $(USER)@$(HOST) -e "mirror -R $(OUTPUTDIR) $(TARGETDIR) ; quit"

clean:
	rm -rf $(OUTPUTDIR)

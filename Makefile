.PHONY:
clean:
	-rm -r dist/*

.PHONY:
build:
	@cd zip_root && zip -r ../dist/body.zip *
	@cat header.php dist/body.zip > dist/self_extract.php
	@rm dist/body.zip
	@echo "### builded. use dist/self_extract.php ###"

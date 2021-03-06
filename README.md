# Tool for build self extracting php.

Generate self extracting php file.

## usage generated php file.

1. upload `self_extract.php` to directory where you want to extract.
2. execute(or open browser)
3. done! (`self_extract.php` will be delete self in normally.)

## how it works

Generated Php file is concated `header.php` and zipped binary data.

> So, please upload by BINARY mode if you use ftp.

## how to use (build)

```
$ rm -r zip_root/*
$ cp /your/files zip_root/
$ make build
```

Will be generate `dist/self_extract.php`.

Upload somewhere, and run.

## license

MIT LICENSE

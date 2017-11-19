#!/bin/bash

tmpdir="/tmp"
rootdir="$(realpath $(dirname $(dirname $0)))"
cd "$rootdir"

rm -rf "$tmpdir/s9e"
mkdir -p "$tmpdir/s9e/notoemoji/config"

files="
	LICENSE
	README.md
	composer.json
	config/services.yml
	listener.php
";
for file in $files;
do
	cp "$file" "$tmpdir/s9e/notoemoji/$file"
done

cd "$tmpdir"
rm -f "$tmpdir/notoemoji.zip"
kzip -r -y "$tmpdir/notoemoji.zip" s9e
advzip -z4 "$tmpdir/notoemoji.zip"

rm -rf "$tmpdir/s9e"
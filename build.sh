rm -r -f dist
mkdir dist
cp -r -t dist *.php images inc js template-parts
sass --update sass:dist/ -t compressed

# Pfersick
Theme for lazychickenfarm.com

To add dependencies (requires Ruby and RubyGems):

```
>gem install bundler
>bundle install
>bourbon install --path=sass/vendor
```

To update stylesheets:
```
>sass --watch sass:./ -t expanded
```

For production, minified and without sourcemap:
```
>sass --update sass:./ -t compressed --sourcemap=none
```

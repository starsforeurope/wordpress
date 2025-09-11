# wordpress

- Open wordpress app with Flywheel's Local

- Edit

- Generate static website with the Simply-static plugin

- Copy to /docs
```shell
rsync -r app/public/wp-content/uploads/simply-static/temp-files/simply-static-*/* ./docs/
```

- From $HOME, commit all changes and push (temp and build files are untracked)
```shell
cd Local\ Sites/starsforeurope/
git add .
git commit -m 'message'
git push
```

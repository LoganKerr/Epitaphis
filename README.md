## Setup

Epitaphis runs on a [LAMP stack](https://en.wikipedia.org/wiki/LAMP_(software_bundle)) so make sure you have one set up before trying to setup the site

Twig is a template engine for PHP that helps with [MVC](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller). You can install Twig by running the following command:

```
composer require twig/twig:~2.0
```

If you receive a command not found error when trying to run composer, then you must install composer first by following the directions [here](https://getcomposer.org/doc/00-intro.md)

the database structure is stored in resources/db_schema. Please import it when it is updated and export it when you make changes.

If you need help with git please reference guides like [this](http://rogerdudler.github.io/git-guide/)

## Getting Started

When contributing code make sure you are on your own branch. When you feel a deep urge to merge with master, instead create a merge request with master. Team Leader(Logan) will handle merges into master.

When you find issues or think of ideas, create an issue for them on the gitlab site. Don't be afraid to assign them to someone else or create new labels.

When you are unsure of what to work on, pick up a gitlab issue and assign it to yourself so no one else begins working on it.

## Creating merge requests

Merge requests must be made through [GitLab](https://gitlab.com/Epitaphis/Epitaphis/merge_requests).

## Updating your branch

If you find your branch is behind master and want to update it, run

```
git merge master
git push
```

when on your branch.

Note: Make sure you commit and push all changes before merging, or you will face merge conflicts.

######  Please add more to me ;(


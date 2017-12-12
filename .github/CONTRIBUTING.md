# Contributing

## Pull Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to run `composer style`, which will apply all code-style fixes necessary.

- **Add tests!** - Your patch probably won't be accepted if it doesn't have tests.

- **Tests must be clear in meaning** - We value clarity in meaning / purposes behind tests. If there is excessive setup required for a test, it should be hidden behind an intention-revealing (and possibly re-usable) method.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Create feature branches** - Feature branches are critically important if you're going to be sending us more than one contribution. Don't send a PR from `master`!

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests. Large pull requests are difficult to review and manage.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. [Appropriate formatting of commit messages](http://chris.beams.io/posts/git-commit/) is also appreciated!

- **Don't close issues via commit message** - We would rather handle these actions ourselves, especially for longer-running issues that may have many PRs submitting against them.

## Running tests

Run 
```
$ composer test

```
To run unit tests

Run 
```
$ composer infection

```
To run the mutation tests

Run 
```
$ composer style

```
To run our two types of style checks

 * The ```php-cs-fixer``` check, which automatically fixes itself. 
 * The ```ProjectCodeTest``` check, which needs to be fixed by hand.


Run 
```
$ composer all-checks 

```
To run all tests and style checks.

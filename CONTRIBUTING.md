# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/danielebuso/laravel-countries).

## Pull Requests

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](https://semver.org/). Randomly breaking public APIs is not an option.

- **Create feature branches** - Don't ask us to pull from your main branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](https://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Adding New Language Translations

To add support for a new language:

1. Create a new translation file in `resources/data/translations/` named with the language code (e.g., `pt.php` for Portuguese)
2. Follow the same structure as existing translation files (e.g., `es.php`, `fr.php`)
3. Ensure all country alpha-2 codes are present in the translation file
4. Update the README.md to include the new language in the supported languages list
5. Add tests for the new language in `tests/MultilanguageTest.php`

## Running Tests

```bash
composer test
```

## Code Style

We use [Laravel Pint](https://laravel.com/docs/pint) for code style. You can fix code style issues by running:

```bash
composer format
```

**Happy coding**!

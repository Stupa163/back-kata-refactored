# Kata Test refactoring process

- To begin with, I upgraded PHP to version `8.0`. That being done, I removed the old faker package (`fzaninotto/faker`) because we weren't able to use it with a newer version of PHP. I replaced it with a similar package (`fakerphp/faker`).


- With a fresh PHP `8.0`, I was then triggered by the `require_once` lines at the begining of the `example.php` file. I then chose to implement the composer autoloader and add namespaces to all the classes.


- Another great thing I now can do with PHP `8.0` is parameters and properties typing. I then typed all the classes properties and the functions' parameters. I also took the opportunity to remove a few unused properties (mostly in the Entities). Alongside properties' typing, I also made all the properties `private` or `protected` (depending on the conext) and created getters and fluent setters.


- While typing the Entities' properties, I realized all the Entities have an id, which make this part of the code duplicated for each entity. So I decided to create an abstract `Entity` class which will implement the `$id` property and its getter and setter.


- I also added a `Makefile`. Not super uber useful but it might allow everyone to run the same command faster in some specific cases.


- After this came probably the most important part of this refactoring process, I completly changed the `TemplateManager`, I had to make that refact without changing the `getTemplateComputed()` signature, but since, after my refact, the second parameter became useless, I raised a deprecation warning when this one is used. I made the service as scalable as possible without making a huge and needlessly complicated.


- The last part I took care of is the testing part. For this one, I upgraded PHPUnit to version 9.5 in order to be able to use a bunch of cool features (providers, mocks, ect...). I didn't only refactor the test file, I also added a trait (`ReflectionTrait`) which can be used in tests, but we could imagine using it in a service which would need to access a private property for example. Finaly, for the test in itself, I wrote it using a provider to easily test many cases.
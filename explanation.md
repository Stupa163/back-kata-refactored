# Kata Test refactoring process

- To begin with, I upgraded PHP to version `8.0`. That being done, I removed the old faker package (`fzaninotto/faker`) because we weren't able to use it with a newer version of PHP. I replaced it with a similar package (`fakerphp/faker`).


- With a fresh PHP `8.0`, I was then bothered by the `require_once` lines at the begining of the `example.php` file. I then chose to implement the composer autoloader and add namespaces to all the classes.


- A couple of great things I can now implement with PHP `8.0` are parameters and typed properties. I then typed all the class properties and the function parameters. I also took the opportunity to remove a few unused properties (mostly in the Entities). Alongside typed properties, I also made all the properties `private` or `protected` (depending on the conext) and created getters and fluent setters.


- While typing the Entitiy properties, I realized all the Entities have an id, which make this part of the code duplicated for each entity. So I decided to create an abstract `Entity` class which will implement the `$id` property and its getter and setter.


- I also added a `Makefile`. Not super useful but it might allow everyone to run the same command faster in some specific cases.


- After this, we reached the most important part of this refactoring process. I completly changed the `TemplateManager`. I had to make that refactorization without changing the `getTemplateComputed()` signature, which in turn rendered the second parameter useless. So I raised a deprecation warning when it is used. I made the service as scalable as possible without making it huge and needlessly complicated.


- The last part I took care of is the testing part. Here, I upgraded PHPUnit to version 9.5 in order to be able to use a bunch of cool features (providers, mocks, etc...). Not only did I refactor the test file, I also added a trait (`ReflectionTrait`) which can be used in tests. But although we could imagine using it in a service which would, for example, need to access a private property. Finally, for the test itself, I wrote it using a provider to easily test multiple cases.
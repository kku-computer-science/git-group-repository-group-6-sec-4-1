# Deprecations

<<<<<<< HEAD
=======
## Soft Deprecations

This functionality is currently [soft-deprecated](https://phpunit.de/backward-compatibility.html#soft-deprecation):

### Writing Tests

#### Test Double API

| Issue                                                             | Description                       | Since | Replacement |
|-------------------------------------------------------------------|-----------------------------------|-------|-------------|
| [#3687](https://github.com/sebastianbergmann/phpunit/issues/3687) | `MockBuilder::setMethods()`       | 8.3.0 |             |
| [#3687](https://github.com/sebastianbergmann/phpunit/issues/3687) | `MockBuilder::setMethodsExcept()` | 9.6.0 |             | 

>>>>>>> main
## Hard Deprecations

This functionality is currently [hard-deprecated](https://phpunit.de/backward-compatibility.html#hard-deprecation):

### Writing Tests

#### Assertions, Constraints, and Expectations

<<<<<<< HEAD
| Issue                                                             | Description                                  | Since  | Replacement                                                                                                                                                                                               |
|-------------------------------------------------------------------|----------------------------------------------|--------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [#5472](https://github.com/sebastianbergmann/phpunit/issues/5472) | `Assert::assertStringNotMatchesFormat()`     | 10.4.0 |                                                                                                                                                                                                           |
| [#5472](https://github.com/sebastianbergmann/phpunit/issues/5472) | `Assert::assertStringNotMatchesFormatFile()` | 10.4.0 |                                                                                                                                                                                                           |

#### Test Double API

| Issue                                                             | Description                                                                    | Since  | Replacement                                                                             |
|-------------------------------------------------------------------|--------------------------------------------------------------------------------|--------|-----------------------------------------------------------------------------------------|
| [#5240](https://github.com/sebastianbergmann/phpunit/issues/5240) | `TestCase::createTestProxy()`                                                  | 10.1.0 |                                                                                         |
| [#5241](https://github.com/sebastianbergmann/phpunit/issues/5241) | `TestCase::getMockForAbstractClass()`                                          | 10.1.0 |                                                                                         |
| [#5242](https://github.com/sebastianbergmann/phpunit/issues/5242) | `TestCase::getMockFromWsdl()`                                                  | 10.1.0 |                                                                                         |
| [#5243](https://github.com/sebastianbergmann/phpunit/issues/5243) | `TestCase::getMockForTrait()`                                                  | 10.1.0 |                                                                                         |
| [#5244](https://github.com/sebastianbergmann/phpunit/issues/5244) | `TestCase::getObjectForTrait()`                                                | 10.1.0 |                                                                                         |
| [#5305](https://github.com/sebastianbergmann/phpunit/issues/5305) | `MockBuilder::getMockForAbstractClass()`                                       | 10.1.0 |                                                                                         |
| [#5306](https://github.com/sebastianbergmann/phpunit/issues/5306) | `MockBuilder::getMockForTrait()`                                               | 10.1.0 |                                                                                         |
| [#5307](https://github.com/sebastianbergmann/phpunit/issues/5307) | `MockBuilder::disableProxyingToOriginalMethods()`                              | 10.1.0 |                                                                                         |
| [#5307](https://github.com/sebastianbergmann/phpunit/issues/5307) | `MockBuilder::enableProxyingToOriginalMethods()`                               | 10.1.0 |                                                                                         |
| [#5307](https://github.com/sebastianbergmann/phpunit/issues/5307) | `MockBuilder::setProxyTarget()`                                                | 10.1.0 |                                                                                         |
| [#5308](https://github.com/sebastianbergmann/phpunit/issues/5308) | `MockBuilder::allowMockingUnknownTypes()`                                      | 10.1.0 |                                                                                         |
| [#5308](https://github.com/sebastianbergmann/phpunit/issues/5308) | `MockBuilder::disallowMockingUnknownTypes()`                                   | 10.1.0 |                                                                                         |
| [#5309](https://github.com/sebastianbergmann/phpunit/issues/5309) | `MockBuilder::disableAutoload()`                                               | 10.1.0 |                                                                                         |
| [#5309](https://github.com/sebastianbergmann/phpunit/issues/5309) | `MockBuilder::enableAutoload()`                                                | 10.1.0 |                                                                                         |
| [#5315](https://github.com/sebastianbergmann/phpunit/issues/5315) | `MockBuilder::disableArgumentCloning()`                                        | 10.1.0 |                                                                                         |
| [#5315](https://github.com/sebastianbergmann/phpunit/issues/5315) | `MockBuilder::enableArgumentCloning()`                                         | 10.1.0 |                                                                                         |
| [#5320](https://github.com/sebastianbergmann/phpunit/issues/5320) | `MockBuilder::addMethods()`                                                    | 10.1.0 |                                                                                         |
| [#5415](https://github.com/sebastianbergmann/phpunit/issues/5415) | Support for doubling interfaces (or classes) that have a method named `method` | 11.0.0 |                                                                                         |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::onConsecutiveCalls()`                                               | 10.3.0 | Use `$double->willReturn()` instead of `$double->will($this->onConsecutiveCalls())`     |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::returnArgument()`                                                   | 10.3.0 | Use `$double->willReturnArgument()` instead of `$double->will($this->returnArgument())` |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::returnCallback()`                                                   | 10.3.0 | Use `$double->willReturnCallback()` instead of `$double->will($this->returnCallback())` |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::returnSelf()`                                                       | 10.3.0 | Use `$double->willReturnSelf()` instead of `$double->will($this->returnSelf())`         |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::returnValue()`                                                      | 10.3.0 | Use `$double->willReturn()` instead of `$double->will($this->returnValue())`            |
| [#5423](https://github.com/sebastianbergmann/phpunit/issues/5423) | `TestCase::returnValueMap()`                                                   | 10.3.0 | Use `$double->willReturnMap()` instead of `$double->will($this->returnValueMap())`      |
| [#5535](https://github.com/sebastianbergmann/phpunit/issues/5525) | Configuring expectations using `expects()` on test stubs                       | 11.0.0 | Create a mock object when you need to configure expectations on a test double           |

### Running Tests

| Issue                                                             | Description                                                                                                                           | Since  | Replacement                                                                                        |
|-------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|--------|----------------------------------------------------------------------------------------------------|
| [#5689](https://github.com/sebastianbergmann/phpunit/issues/5689) | `restrictDeprecations` attribute on the `<source>` element of the XML configuration file                                              | 11.1.0 | Use `ignoreSelfDeprecations`, `ignoreDirectDeprecations`, and `ignoreIndirectDeprecations` instead |
| [#5709](https://github.com/sebastianbergmann/phpunit/issues/5709) | Support for using comma-separated values with the `--group`, `--exclude-group`, `--covers`, `--uses`, and `--test-suffix` CLI options | 11.1.0 | Use `--group foo --group bar` instead of `--group foo,bar`, for example                            |

#### Miscellaneous

| Issue                                                             | Description                                                 | Since  | Replacement                                                                             |
|-------------------------------------------------------------------|-------------------------------------------------------------|--------|-----------------------------------------------------------------------------------------|
| [#4505](https://github.com/sebastianbergmann/phpunit/issues/4505) | Metadata in doc-comments                                    | 10.3.0 | Metadata in attributes                                                                  |
| [#5214](https://github.com/sebastianbergmann/phpunit/issues/5214) | `TestCase::iniSet()`                                        | 10.3.0 |                                                                                         |
| [#5216](https://github.com/sebastianbergmann/phpunit/issues/5216) | `TestCase::setLocale()`                                     | 10.3.0 |                                                                                         |
| [#5800](https://github.com/sebastianbergmann/phpunit/issues/5800) | Targeting traits with `#[CoversClass]` and `#[UsesClass]`   | 11.2.0 | `#[CoversClass]` and `#[UsesClass]` also target the traits used by the targeted classes |
| [#5951](https://github.com/sebastianbergmann/phpunit/issues/5951) | `includeUncoveredFiles` configuration option                | 11.4.0 |                                                                                         |

## Soft Deprecations

This functionality is currently [soft-deprecated](https://phpunit.de/backward-compatibility.html#soft-deprecation):

### Writing Tests

#### Assertions, Constraints, and Expectations

| Issue                                                             | Description                       | Since  | Replacement                                                                                                                                                                                                                                                                                                                                                                                                                       |
|-------------------------------------------------------------------|-----------------------------------|--------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [#6052](https://github.com/sebastianbergmann/phpunit/issues/6052) | `Assert::isType()`                | 11.5.0 | Use `isArray()`, `isBool()`, `isCallable()`, `isFloat()`, `isInt()`, `isIterable()`, `isNull()`, `isNumeric()`, `isObject()`, `isResource()`, `isClosedResource()`, `isScalar()`, or `isString()` instead                                                                                                                                                                                                                         |
| [#6055](https://github.com/sebastianbergmann/phpunit/issues/6055) | `Assert::assertContainsOnly()`    | 11.5.0 | Use `assertContainsOnlyArray()`, `assertContainsOnlyBool()`, `assertContainsOnlyCallable()`, `assertContainsOnlyFloat()`, `assertContainsOnlyInt()`, `assertContainsOnlyIterable()`, `assertContainsOnlyNumeric()`, `assertContainsOnlyObject()`, `assertContainsOnlyResource()`, `assertContainsOnlyClosedResource()`, `assertContainsOnlyScalar()`, or `assertContainsOnlyString()` instead                                     |
| [#6055](https://github.com/sebastianbergmann/phpunit/issues/6055) | `Assert::assertNotContainsOnly()` | 11.5.0 | Use `assertContainsNotOnlyArray()`, `assertContainsNotOnlyBool()`, `assertContainsNotOnlyCallable()`, `assertContainsNotOnlyFloat()`, `assertContainsNotOnlyInt()`, `assertContainsNotOnlyIterable()`, `assertContainsNotOnlyNumeric()`, `assertContainsNotOnlyObject()`, `assertContainsNotOnlyResource()`, `assertContainsNotOnlyClosedResource()`, `assertContainsNotOnlyScalar()`, or `assertContainsNotOnlyString()` instead |
| [#6059](https://github.com/sebastianbergmann/phpunit/issues/6059) | `Assert::containsOnly()`          | 11.5.0 | Use `containsOnlyArray()`, `containsOnlyBool()`, `containsOnlyCallable()`, `containsOnlyFloat()`, `containsOnlyInt()`, `containsOnlyIterable()`, `containsOnlyNumeric()`, `containsOnlyObject()`, `containsOnlyResource()`, `containsOnlyClosedResource()`, `containsOnlyScalar()`, or `containsOnlyString()`  instead                                                                                                            |
=======
| Issue                                                             | Description                                    | Since | Replacement                                       |
|-------------------------------------------------------------------|------------------------------------------------|-------|---------------------------------------------------|
| [#4062](https://github.com/sebastianbergmann/phpunit/issues/4062) | `TestCase::assertNotIsReadable()`              | 9.1.0 | `TestCase::assertIsNotReadable()`                 |
| [#4065](https://github.com/sebastianbergmann/phpunit/issues/4065) | `TestCase::assertNotIsWritable()`              | 9.1.0 | `TestCase::assertIsNotWritable()`                 |
| [#4068](https://github.com/sebastianbergmann/phpunit/issues/4068) | `TestCase::assertDirectoryNotExists()`         | 9.1.0 | `TestCase::assertDirectoryDoesNotExist()`         |
| [#4071](https://github.com/sebastianbergmann/phpunit/issues/4071) | `TestCase::assertDirectoryNotIsReadable()`     | 9.1.0 | `TestCase::assertDirectoryIsNotReadable()`        |
| [#4074](https://github.com/sebastianbergmann/phpunit/issues/4074) | `TestCase::assertDirectoryNotIsWritable()`     | 9.1.0 | `TestCase::assertDirectoryIsNotWritable()`        |
| [#4077](https://github.com/sebastianbergmann/phpunit/issues/4077) | `TestCase::assertFileNotExists()`              | 9.1.0 | `TestCase::assertFileDoesNotExist()`              |
| [#4080](https://github.com/sebastianbergmann/phpunit/issues/4080) | `TestCase::assertFileNotIsReadable()`          | 9.1.0 | `TestCase::assertFileIsNotReadable()`             |
| [#4083](https://github.com/sebastianbergmann/phpunit/issues/4083) | `TestCase::assertFileNotIsWritable()`          | 9.1.0 | `TestCase::assertFileIsNotWritable()`             |
| [#4086](https://github.com/sebastianbergmann/phpunit/issues/4086) | `TestCase::assertRegExp()`                     | 9.1.0 | `TestCase::assertMatchesRegularExpression()`      |
| [#4089](https://github.com/sebastianbergmann/phpunit/issues/4089) | `TestCase::assertNotRegExp()`                  | 9.1.0 | `TestCase::assertDoesNotMatchRegularExpression()` |
| [#4091](https://github.com/sebastianbergmann/phpunit/issues/4091) | `TestCase::assertEqualXMLStructure()`          | 9.1.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectDeprecation()`                | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectDeprecationMessage()`         | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectDeprecationMessageMatches()`  | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectError()`                      | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectErrorMessage()`               | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectErrorMessageMatches()`        | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectNotice()`                     | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectNoticeMessage()`              | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectNoticeMessageMatches()`       | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectWarning()`                    | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectWarningMessage()`             | 9.6.0 |                                                   |
| [#5062](https://github.com/sebastianbergmann/phpunit/issues/5062) | `TestCase::expectWarningMessageMatches()`      | 9.6.0 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertClassHasAttribute()`          | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertClassNotHasAttribute()`       | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertClassHasStaticAttribute()`    | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertClassNotHasStaticAttribute()` | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertObjectHasAttribute()`         | 9.6.1 | `TestCase::assertObjectHasProperty()`             |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::assertObjectNotHasAttribute()`      | 9.6.1 | `TestCase::assertObjectNotHasProperty()`          |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::classHasAttribute()`                | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::classHasStaticAttribute()`          | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `TestCase::objectHasAttribute()`               | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `ClassHasAttribute`                            | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `ClassHasStaticAttribute`                      | 9.6.1 |                                                   |
| [#4601](https://github.com/sebastianbergmann/phpunit/issues/4601) | `ObjectHasAttribute`                           | 9.6.1 | `ObjectHasProperty`                               |

#### Test Double API

| Issue                                                             | Description                           | Since | Replacement                                                             |
|-------------------------------------------------------------------|---------------------------------------|-------|-------------------------------------------------------------------------|
| [#4141](https://github.com/sebastianbergmann/phpunit/issues/4141) | `TestCase::prophesize()`              | 9.1.0 | [phpspec/prophecy-phpunit](https://github.com/phpspec/prophecy-phpunit) |
| [#4297](https://github.com/sebastianbergmann/phpunit/issues/4297) | `TestCase::at()`                      | 9.3.0 |                                                                         |
| [#4297](https://github.com/sebastianbergmann/phpunit/issues/4297) | `InvokedAtIndex`                      | 9.3.0 |                                                                         |
| [#5063](https://github.com/sebastianbergmann/phpunit/issues/5063) | `InvocationMocker::withConsecutive()` | 9.6.0 |                                                                         |
| [#5063](https://github.com/sebastianbergmann/phpunit/issues/5063) | `ConsecutiveParameters`               | 9.6.0 |                                                                         |
| [#5064](https://github.com/sebastianbergmann/phpunit/issues/5064) | `TestCase::getMockClass()`            | 9.6.0 |                                                                         |

#### Miscellaneous

| Issue                                                             | Description                                  | Since | Replacement                                    |
|-------------------------------------------------------------------|----------------------------------------------|-------|------------------------------------------------|
| [#5132](https://github.com/sebastianbergmann/phpunit/issues/5132) | `Test` suffix for abstract test case classes |       |                                                |
|                                                                   | `TestCase::$backupGlobalsBlacklist`          | 9.3.0 | `TestCase::$backupGlobalsExcludeList`          |
|                                                                   | `TestCase::$backupStaticAttributesBlacklist` | 9.3.0 | `TestCase::$backupStaticAttributesExcludeList` |

### Extending PHPUnit

| Issue                                                             | Description                          | Since | Replacement                                                 |
|-------------------------------------------------------------------|--------------------------------------|-------|-------------------------------------------------------------|
| [#4676](https://github.com/sebastianbergmann/phpunit/issues/4676) | `TestListener`                       | 8.0.0 | [Event System](https://docs.phpunit.de/en/10.3/events.html) |
| [#4039](https://github.com/sebastianbergmann/phpunit/issues/4039) | `Command::handleLoader()`            | 9.1.0 |                                                             |
| [#4039](https://github.com/sebastianbergmann/phpunit/issues/4039) | `TestSuiteLoader`                    | 9.1.0 |                                                             |
| [#4039](https://github.com/sebastianbergmann/phpunit/issues/4039) | `StandardTestSuiteLoader`            | 9.1.0 |                                                             |
| [#4676](https://github.com/sebastianbergmann/phpunit/issues/4676) | `TestListenerDefaultImplementation`  | 8.2.4 | [Event System](https://docs.phpunit.de/en/10.3/events.html) |
>>>>>>> main

## Introduction

This library get supported currencies from the exchange and gives us conversions from one currency to another   

## TODOS
We could improve this library by the following suggestions.
- We need to implement cache techniques for the better performance and minimum third party api calls
- Right now to execute test cases we need to do api calls. We should also minimize these calls by providing 
  mock data, and a bit of refactoring in the code.    


## Feature Suggestion 
- We need to implement "Circuit Break Pattern" to interact with the third party exchange api. So that if third party api is not 
responding for certain threshold then we break the circuit for some time and make it  available once third party api is live again, 
so with this implementation client doesn't need to  wait for response from third party when it is not responding. 
    

## Getting Started

Make sure you have composer installed.

Run `composer install` to install required dependencies.

To see if your code works as expected, some testcases have been created. They are under the `tests/` directory.

To run the tests call `composer test`


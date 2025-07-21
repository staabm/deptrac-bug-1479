## Repro for deptrac issue 1479

https://github.com/staabm/deptrac-bug-1479

## Repro Steps

- clone the repo
- run `vendor/bin/deptrac --report-uncovered`

expected: the dependency of `myapp\controller\IndexController` on `RedirectResult` should not be treated as uncovered.

actual:
```
 ----------- ----------------------------------------------------------------------------- 
  Reason      Controller                                                                   
 ----------- ----------------------------------------------------------------------------- 
  Uncovered   myapp\controller\IndexController has uncovered dependency on RedirectResult  
              /Users/m.staab/Documents/GitHub/deptrac-bug-1479/lib/IndexController.php:5   
 ----------- ----------------------------------------------------------------------------- 

```

# git

## config
```
git config --global user.name "Felix"
git config --global user.emal "felix@vm.com"
git config --list | -l
git config pull.rebase false
git config core.fscache false  //true需要discard两次
```

## ssh key
```
ssh-keygen -t rsa -C "felix@vm.com"
将id_rsa.pub公钥内容复制到github ssh keys
ssh -T git@github.com // Hi bluesaka! You've successfully authenticated...
```

## clone
```
git clone git@github.com:bluesaka/git-test.git  project-dir  (不写默认就是项目名称)
git clone https://github.com/bluesaka/git-test.git
```

## commit
```
git add 1.md
git commit -m "commit message"
git commit -am "add-commit message" （新文件必须用git add）
git push origin master

git status
git status -s
git log
```

## reset
```
git reset
git reset 1.md 重置暂存区1.md 的变更
git reset --soft hash1 : 重置分支至hash1，保留修改
git reset --hard hash2 : 重置分支至hash2，不保留修改
```
## stash
```
git stash
git stash save "message"
git stash list 查看stash列表
git stash show stash@{0}  显示stash详细内容
git stash apply stash@{0}  应用stash，不删除
git stash pop stash@{0}  应用stash，并删除
git stash drop stash@{0}  删除stash
git stash clear  删除所有stash
```

## remote
```
git remote
git remote -v
git remote rm origin
git remote add origin git@github.com:bluesaka/git-test.git
git remote show origin
```

## branch & checkout
```
git branch 查看本地分支
git branch -v  查看本地分支信息
git branch -vv  查看本地分支信息以及track追踪的远程分支
git branch -a  查看所有分支
git branch -r  查看远程分支
git branch -d xxx   删除本地分支
git branch -D xxx  强制删除本地分支

git branch develop 创建本地develop分支
git branch dev origin/develop 创建本地dev分支，并跟踪远程develop分支
git branch --track dev origin/develop 同上
git branch -m dev develop 重命名本地dev分支为develop
git branch -u origin/master local_branch  设置本地分支跟踪远程分支

git checkout develop  切换到develop分支
git checkout .  : 丢弃本地所有修改

git fetch (origin)  获取远程更新
git fetch origin -p 获取远程更新并删除远程不存在的分支 -p:prune --prune
```

## push
```
git push origin dev:develop  本地dev推送至远程develop
git push origin :develop  删除远程develop分支
git push --delete origin develop  同上
```

## pull
```
git pull = git fetch + git merge
git pull origin master:master 更新本地分支至远程分支的最新状态
git fetch origin master  获取远程master分支最新的commit id
git merge origin/master 合并远程master分支至当前分支
git pull --rebase
```

## rebase
```
git rebase --continue | --skip | --abort | --edit-todo
开发分支rebase: git fetch origin -> git rebase origin/master (-> 解决冲突 -> git add(no commit) -> git rebase --continue)  -> git push origin hotfix_xx -f (若不加-f，远程最新节点不一致，推不了)
线上分支merge: git fetch origin  -> git merge (--no-ff: 推荐，会有个merge的点) origin/hotfix-xx  -> git push origin master
--no-ff:no fast-forward， fast-forward是git直接把HEAD指针指向合并分支的头，完成合并。属于“快进方式”，不过这种情况如果删除分支，则会丢失分支信息。因为在这个过程中没有创建commit
```

## squash
```
将多个提交合并成一个
1. git rebase -i HEAD~8
2. 将除一个之外的pick改为s
3. git push origin dev -f 
```

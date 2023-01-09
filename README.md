# 工具箱
此仓库包含了那些自己开发/二开的工具。

## 工具目录
### 1. [enum_thinkadmin.php](https://raw.githubusercontent.com/ptboi6766/Tools/main/enum_thinkadmin.php)
这个工具是一个针对thinkadmin v5的枚举工具。
v5同v6都有任意读取的漏洞只是v5要自己加密目录路径，v6的API有自带的加密功能。
要用在v6的话，好像就不许要那个`encode()`功能了（可以看以下有关链接）。

### 使用说明
需要自己手动改的变数：
- `$dir_txt`
- `$url`
- `$web_dir`

执行如以下：
```
php enum_thinkadmin.pgp
```

### 有关链接
- https://github.com/zoujingli/ThinkAdmin/issues/244
- https://www.exploit-db.com/exploits/48812

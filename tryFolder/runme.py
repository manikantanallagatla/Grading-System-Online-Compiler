#!/usr/bin/env python
import urllib2
import base64
import HackerRank
from pprint import pprint
import urllib2
import sys
import json

api_key = #your apikey
f = open('/opt/lampp/htdocs/tryFolder/code.txt')
source = f.read()
lang = sys.argv[1]
f = open('/opt/lampp/htdocs/tryFolder/testcases.txt')
test_cases_file = f.readlines()

testcases = '[\"'+str(test_cases_file[0]).strip()
for i in range(1,len(test_cases_file)):
	testcases+='\\n'+str(test_cases_file[i]).strip()
testcases+='\"]'
#testcases =  testcases.strip()
format = "JSON"

api_client = HackerRank.swagger.ApiClient()
checker_api = HackerRank.CheckerApi(api_client)
#print source
#print testcases
response = checker_api.submission(api_key, source, lang, testcases, format, callback_url="https://testing.com/response/handler", wait="true")

print response.result.message
print response.result.stdout
# print json.dumps({'stdout': response.result.stdout, 'status':response.result.message})
# print response.result.message
#print response.result.stdout    #for output
#print response.result.__dict__ #for all methods
#print response.result.__dict__           #for execution message



from urllib.request import Request, urlopen
from bs4 import BeautifulSoup as soup
import sys
def autoemploi():
	links=[]
	url = "https://ensaf.ac.ma/?controller=pages&action=emplois"
	req = Request(url , headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246'})
	uh=urlopen(req)
	rawhtml=uh.read()
	scrape=soup(rawhtml,'lxml')
	info=scrape.find('div',class_='table-responsive')
	test=info.tbody
	auto=test.tr
	module=auto.select_one("tr td:nth-of-type(2)")
	for link in module.find_all('a'):
		autourl=link.get('href')
	links.append(autourl)
	return links[-1]
print(autoemploi())
from urllib.request import Request, urlopen
from bs4 import BeautifulSoup as soup
import sys
def webscrape():
	url = "https://ensaf.ac.ma/?controller=pages&action=info"
	req = Request(url , headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246'})
	uh=urlopen(req)
	rawhtml=uh.read()
	scrape=soup(rawhtml,'lxml')
	info=scrape.find('div',class_='table-responsive')
	test=info.tbody
	results=test.find_all('tr')
	modules=[]
	for result in results:
			module=result.select_one("tr td:nth-of-type(2)")
			if (module is not None):
				sousmodule=module.text
				sousmodule=sousmodule.replace('\n', '')
				sousmodule=sousmodule.replace('\t', '')
				sousmodule=sousmodule.replace('1.','')
				sousmodule=sousmodule.replace('é','e')
				sousmodule=sousmodule.replace('è','e')
				sousmodule=sousmodule.replace("’"," ")
				sousmodule=sousmodule.replace("ô",'o')
				sousmodule=sousmodule.replace("'",'')
				sousmodule=sousmodule.replace('û','u')
				sousmodule=sousmodule.replace('à','a')
				sousmodule=sousmodule.replace('œ','oe')
				modules.append(sousmodule.strip())
	modules2=[y for x in modules for y in x.split('2.')]
	modules3=[y for x in modules2 for y in x.split('3.')]
	while ("" in modules3):
		modules3.remove("")
	modules3 = [y.strip() for y in modules3]
	modules3=[x for x in modules3 if not x.startswith("Projet") and not x.startswith("PFA") and not x.startswith("TEC") and not x.startswith("Fran") and not x.startswith("Allemand") and not x.startswith("Anglais") and not x.startswith("Langue") and not x.startswith("Espagnol") and not x.startswith("Stage")]
	return modules3
print(webscrape())
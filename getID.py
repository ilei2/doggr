from bs4 import BeautifulSoup
import requests
import sys
from sys import stdin

#import googlemaps
#from datetime import datetime

string = sys.argv[1] # dog name and id
array = string.split(":")
tag = array[1]
if (tag[8] != "-"):
  tag = tag[:6] + "-" + tag[6:]
  tag = tag[:4] + "-" + tag[4:]
  tag = tag[:2] + "-" + tag[2:]
dog = array[0]
dog = dog.lower()
ID = array[1]
#print("ID:")
#print(ID)
#print("newtag:")
#print(tag)
ID = tag

str1 = "http://"
str2 = ".rescueme.org/Illinois"

print "<body bgcolor=\"#EDE1D1\">"
link = str1 + str(dog)+ str2
#print(link)

redirect = str1 + str(dog) + str2 + "?" + tag
#print(redirect)

f = requests.get(link)
#t = f.text.encode('ascii', 'ignore').decode('ascii')
t = f.text.encode('utf-8').decode('ascii', 'ignore')
soup = BeautifulSoup(t, "html.parser")

countDog = 0
findName = 0
getInfo = 0

arrSummary = []
arrName = []
chunk = []
chunk2 = []
idFound = 0

for test in soup.find_all("td", valign="middle"):
  #Gets age of each Dog
  getInfo = 0
  for center in test.find_all("center"):
    if getInfo == 0:
      getInfo = 1
      infoCount = 0
      for age in center.find_all("b"):
        infoCount += 1
        if infoCount == 2:
          getAge = age.text
          agetag = "<b>Age:</b> " + age.text

  #gets ID and Name of each Dog
  for n in test.find_all("font", color="505050"):
      for c in n.find_all("font", size="5"):
        count = 0
        if findName == 0:
          findName = 1
          for getb in c.find_all("b"):
            count += 1
            if count == 1:
              testlabel = getb.text
              idtag = testlabel
              #print(idtag)
            if count == 2:
              namelabel = getb.text
              nametag = "<b>Name:</b> " + namelabel
              #print(nametag)
  findName = 0
  #idFound = 0

  #gets summary of each Dog
  for t in test.find_all("font", face="verdana"):
    for d in t.find_all("div", style="text-align:justify;word-wrap:break-word"):
        for f in d.find_all("font", color="111111"):
          for b in f.find_all("b"):
	    if (idtag == ID): #ONLY PRINT SELECTED ID
	      idFound = 1
	      countDog += 1
              summary = b.text
              summary = summary.replace("... (Read More)", "")
              summary = summary.encode('utf-8')
              split = summary.split("(Less)")
	      data = "<br><center>"+nametag+"</center>"
	      data = data + "<br><center>"+agetag+"</center>"
	      arrName.append(nametag)
	      data = data + "<br><center><b>ID:</b> "+dog+"_"+idtag+"<br><br></center>"
	      data = data + "<br><center><b>Link:</b>" + redirect + "<br><br></center>"
	      arrSummary.append(split[0])
	      chunk.append(data)
	      chunk2.append(split[0])
	      print(data)
	      print(split[0])
   	      break
#print(idFound)
if idFound == 0:
  print("Unable to find the dog based on your ID :(")

if countDog == 0:
  if ("-" in dog):
    dog = dog.replace("-", " ") 
  string = "Unable to find any "+dog+"s up for adoption in Illinois :("
  print(string)

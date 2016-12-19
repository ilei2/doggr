from bs4 import BeautifulSoup
import requests
import sys
from sys import stdin

import googlemaps
from datetime import datetime
print("entering rec.py")
"""
print "<body bgcolor=\"#EDE1D1\">"
str1 = "http://"
str2 = ".rescueme.org/Illinois"
main = sys.argv[1] #gets name of dog
dest = sys.argv[2] #gets 'destination'
dog = main.lower().replace(" ", "")
dog = dog.replace("-", "")
link = str1+dog+str2
#print(link)

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

  #gets summary of each Dog
  for t in test.find_all("font", face="verdana"):
    for d in t.find_all("div", style="text-align:justify;word-wrap:break-word"):
        for f in d.find_all("font", color="111111"):
          for b in f.find_all("b"):
	    countDog += 1
            summary = b.text
            #tab = u'/&nbsp;'
            #summary = summary.strip(tab)
            #summary = summary.replace(u'\&nbsp', "")
            summary = summary.replace("... (Read More)", "")
            summary = summary.encode('utf-8')
            split = summary.split("(Less)")
	    #split[0] = split[0].decode('utf-8')
	    data = "<br><center>"+nametag+"</center>"
              #print("<center>"+nametag+"</center>")
	    data = data + "<br><center>"+agetag+"</center>"
	    arrName.append(nametag)
	    data = data + "<br><center><b>ID:</b> "+dog+"_"+idtag+"</center>"
            #data = data + '<br><center><form action="id.php" method="POST"><b>Get More Info:</b> <input type="submit" name="Name" value="'+dog+"_"+idtag+'"/></form></center>'
	      #print("<br>")
              #print("<center><b>ID:</b> "+dog+"_"+idtag+"</center>")
	    #print('<center><form action="id.php" method="POST">Get More Info: <input type="submit" name="Name" value="'+dog+"_"+idtag+'"/></form></center>')
	    #print('<center><form action="add.php" method="POST">Favorite: <input type="submit" name="Name" value="'++"_"+idtag+'"/></form></center>')
	    #data = data + "<center>"+agetag+"</center><br>"
	      #print("<br>")
              #print("<center>"+agetag+"</center>")
	      #print("<br>")
	      #print("<center>"+split[0]+"</center")
	    arrSummary.append(split[0])
	    #data = data + "<center>" + split[0] + "</center>"
 	      #print("<br><br>")
	    #print(data)
	    #print(split[0])
	    chunk.append(data)
	    chunk2.append(split[0])
   	    break
"""

#Testing to see if Chunk contains all data of dogs
"""for i in range(0, len(chunk)):
  print(chunk[i])
  print(chunk2[i])
  print("<br><br>")
"""

"""
if countDog == 0:
  dog = main.replace("-", " ") 
  string = "Unable to find any "+dog+"s up for adoption in Illinois :("
  print(string)

list1 = []
list2 = []
for a in soup.find_all("center"):
 	for x in a.find_all("font", size="3", color="000099"):
		for c in x.find_all("b"):
			list1.append(str(c).replace("<b>", "").replace("</b>", "").replace(", IL ", "").translate(None, '0123456789'))
		#list1.append(str(c).strip().replace(", IL", "").translate(None, '0123456789'))


#GOOGLE MAP API
origin = []
i = 0
for city in list1:
  city = city.replace(" ", "")
  place = city
  city = city + ", IL" #United States
  origin.append(city)
  #print(city)
  temp = chunk[i]
  if place == "Illinois":
    t = temp + "<br><center><b>State: </b>" + place + "</center><br>"
  else:
    t = temp + "<br><center><b>City: </b>" + city + "</center><br>"
  chunk[i] = t #Adds the location for each shelter dog
  i += 1

gmaps = googlemaps.Client(key="AIzaSyAYnRlmFmbZ9G6XkQ4AXfu0qRYfoVwxjjc")
#destination = ["Champaign, United States"]

array = []
matrix = gmaps.distance_matrix(origin, dest, units="imperial")
#Gets value of Distance
for i in range(0,len(origin)):
  dist = matrix["rows"][i]["elements"][0]["distance"]["text"]
  array.append(dist)

sortedArray = []
checkDist = []
#print("array:<br>")
#print(array)

for i in range(0, len(origin)):
  string = min(array)
  n = array.index(string)
  print(chunk[n])
  if (origin[n] == "Illinois, IL"):
    distance = "<center><b>Distance Unknown.</b></center><br>"
  else:
    distance = "<center><b>Distance from " +dest+ ":</b>"  + array[n] + "</center><br>"
  print(distance)
  print(chunk2[n])
  print("<br><br><br>")
  del array[n]
  del origin[n]
  del chunk[n]
  del chunk2[n]

#print(matrix["rows"][1]["elements"][0]["distance"]["text"])
#print(matrix["rows"][2]["elements"][0]["distance"]["text"])
"""


"""for place in list1:
	list2.append(place.lower().replace(" ", "-") + "-il")
print "List 2:"
print  list2
list3 =[]
distance_link = "http://www.distance-cities.com/distance-"
my_loc = "Champaign"
my_loc = my_loc.lower().replace(" ", "-") + "-il"
print my_loc
for loc in list2:
	list3.append(str(distance_link + loc + "-to-" + my_loc))
print "List 3: "
print  list3

for dlink in list3:
	get_link = requests.get(dlink)
	l = get_link.text.encode('utf-8').decode('ascii', 'ignore')
	bsoup = BeautifulSoup(l, "html.parser")
	
	for jj in bsoup.find_all("table", id="dconversions"):
		for kk in jj.find_all("span", id="straightmi"):
			print kk
		#for kk in jj.find_all("strong", id="straight"):
		#	print kk.text"""

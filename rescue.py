from bs4 import BeautifulSoup
import requests
import sys
from sys import stdin

print "<body bgcolor=\"#EDE1D1\">"
str1 = "http://"
str2 = ".rescueme.org"
dog = sys.argv[1] #gets name of dog
dogTrivia = dog.replace("-", " ")
dog = dog.lower()
dog = dog.replace("-", "")
link = str1+dog+str2
#print(link)

part1 = []
part2 = []
part3 = []

f = requests.get(link)
t = f.text.encode('ascii', 'ignore').decode('ascii')
soup = BeautifulSoup(t, "html.parser")
#soup = BeautifulSoup(t, "lxml")

count = 0
check = ""
for test in soup.find_all("div", align="justify"): #font,face="arial"
  flag = 0
  for test2 in test.find_all('font', color="990000"):
    for p in test2.find_all('b'):
      label = p.text
      if "Trivia" in label:
        flag = 1
      if flag:
        fact = test.text
	fact = fact.encode('ascii', 'ignore').decode('ascii')
	part1 = fact.split(".")
	for index, sentence in enumerate(part1):
		if "Trivia:" in sentence:
			#print sentence
			trivia_p_index = index;
	for elem in part1[0:trivia_p_index]:
		part2.append(elem + ".")
	for item in part1[trivia_p_index:-1]:
		part3.append(item + ".")
	check = "".join(map(str,part2))
	print(check)
	print "<br><br>"
	print "".join(map(str, part3))
        flag = 0

if len(check)==0:
  print("Unable to find further information of this dog breed :(")
  print("<br><br>")
  #print("<img src='https://imgflip.com/s/meme/Doge.jpg' width='400' height='400'>")

print("<br><br>")
str3 = "http://www.petwave.com/Dogs/Breeds/"
str4 = ".aspx"
doggie = sys.argv[1]
doggie = doggie.replace(" ", "-")
link2 = str3+doggie+str4

part4 = []
part5 = []
part6 = []

#print(link2)
s = requests.get(link2)
r = s.text.encode('ascii', 'ignore').decode('ascii')
soup = BeautifulSoup(r, "html.parser")

for breed in soup.find_all("div", {"class" : "pw-breed-char"}):
  for item in breed.find_all("li"):
    label2 = str(item.text)
    part4.append(label2.strip().replace("\r\n", ""))
for a in soup.find_all("div", {"class" : "pw-breed-char"}):
  for b in a.find_all("li"):
    part5.append(b["class"])
for c in part5:
  c = c.replace("pw-char-dots pw-char-", "")
  part6.append(c)
"""  for d in c:
    if d is not "pw-char-dots":
      part6.append(str(d).replace("pw-char-", ""))
"""

"""
for that in soup.find_all("div", class_="pw-breed-char"):
	for item in that.find_all("li"):
		label2 = str(item.text)
		part4.append(label2.strip().replace("\r\n", ""))
for a in soup.find_all("div", class_="pw-breed-char"):
	for b in a.find_all("li"):
		part5.append(b["class"])
#print part2
for c in part5:
	for d in c:
		#print d
		if d != "pw-char-dots":
			part6.append(str(d).replace("pw-char-", ""))

print(part4)
"""

final = ""
#print(part4)
#print(part6)
if (len(part6) > 0):
  for i in range(12):
	if(part6[i] == "1"):
		final = final + str(part4[i]) +  "<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/1_stars.svg/2000px-1_stars.svg.png\" style=\"width:100px;height:30px;\">" + "<br>"
	if(part6[i] == "2"):
		final = final + str(part4[i]) +  "<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/2_stars.svg/2000px-2_stars.svg.png\" style=\"width:100px;height:30px;\">" + "<br>"
	if(part6[i] == "3"):
		final = final + str(part4[i]) + "<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/3_stars.svg/2000px-3_stars.svg.png\" style=\"width:100px;height:30px;\">" + "<br>"
	if(part6[i] == "4"):
		final = final + str(part4[i]) + "<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/4_stars.svg/1280px-4_stars.svg.png\" style=\"width:100px;height:30px;\">" + "<br>"
	if(part6[i] == "5"):
		final = final + str(part4[i]) + "<img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/5_stars.svg/2000px-5_stars.svg.png\" style=\"width:100px;height:30px;\">" + "<br>"

count = 0
if final != "":
  for e in soup.find_all("div", {"class" : "pw-main-content-image"}):
    for g in e.find_all("img"):
      count += 1
      dog_image = g["src"]
      print str("<img src=" + "http://www.petwave.com" + dog_image + ">")
  #print("<br><br><h2>Dog Statistics</h2>")
  #print(final)

if count == 0:
  #getImage = "select Image FROM Dogs WHERE Name = '" + dogTrivia + "';"
  print("retrieve image here")
  img = sys.argv[2]
  print(img)
  #QUERY IMAGE FROM DATABASE HERE
  





if (len(final) > 0):
  print("<br><br><h2>Dog Statistics</h2>")
  print(final)
print "<br>"







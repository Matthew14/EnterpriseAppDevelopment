# The lab wanted all http error codes defined as constants in a file
# There's no way I was doing that by hand

from bs4 import BeautifulSoup
import urllib2

html = urllib2.urlopen('http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml').read()
soup = BeautifulSoup(html)

table = soup.table

rows = table.find_all('tr')

with open('out.php', 'w') as f:
    for row in rows:
        cols = row.find_all('td')
        if len(cols) > 2:
            code = cols[0].contents[0]
            description = cols[1].contents[0].upper().replace(' ', '_').replace('-', '_')
            if '-' not in code and 'UNASSIGNED' not in description:
                f.write('define (\'{}\', \'{}\');\n'.format(description, code))



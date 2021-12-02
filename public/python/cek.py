import sys
import pandas as pd
print('halo')
import requests as rq
from bs4 import BeautifulSoup as bs

a = sys.argv[1]
page = rq.get('https://referensi.data.kemdikbud.go.id/tabs.php?npsn='+a)
soup = bs(page.content, 'html.parser')

#dari html yang didapat dibaca menggunakan pandas untuk mendapatkan tablenya
data_raw = pd.read_html(page.text)



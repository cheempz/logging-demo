# flask example
import requests
from flask import Flask
from appoptics_apm.middleware import AppOpticsApmMiddleware

# the flask app
app = Flask(__name__)

app.wsgi_app = AppOpticsApmMiddleware(app.wsgi_app)

@app.route("/")
def hello():
    return "Hello World!"

@app.route("/rpc/<path:url>")
def rpc(url):
    app.logger.info("URL is {}".format(url))
    response = requests.get(url)
    return "Response headers: {}".format(response.headers)

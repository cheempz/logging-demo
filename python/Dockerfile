FROM python:3.6

RUN apt-get update && apt-get install -y \
    apt-transport-https \
    curl \
    less \
    vim
RUN rm -rf /var/lib/{apt,cache,log}

WORKDIR /code
ADD ./requirements.txt .
ADD ./hello.py .

ENV FLASK_APP hello.py
ENV FLASK_ENV development

RUN pip install -r requirements.txt

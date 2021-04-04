from flask import Flask, send_file, request, make_response, redirect
import random
import os

app = Flask(__name__)

import pickle
import base64

flag = os.environ.get('FLAG', 'actf{FAKE_FLAG}')

print(flag)
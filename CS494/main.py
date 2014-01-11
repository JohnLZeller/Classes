import sqlite3
from flask import Flask, request, session, g, redirect, url_for, abort, render_template, flash
from contextlib import closing
import time
from flask.ext.login import LoginManager, UserMixin, current_user
from flaskext.browserid import BrowserID
from flask.ext.sqlalchemy import SQLAlchemy

## SETUP
DEBUG = True
SECRET_KEY = 'development key'
USERNAME = 'admin'
PASSWORD = 'default'

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:////tmp/flaskr.db'
db = SQLAlchemy(app)
app.config.from_object(__name__)

app.config['BROWSERID_LOGIN_URL'] = "/login"
app.config['BROWSERID_LOGOUT_URL'] = "/logout"
app.config['SECRET_KEY'] = "deterministic"
app.config['TESTING'] = True

class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    email = db.Column(db.UnicodeText, unique=True)
    firstname = db.Column(db.Unicode(40))
    lastname = db.Column(db.Unicode(40))
    date_register = db.Column(db.Integer)
    bio = db.Column(db.Text)
    facebook = db.Column(db.Unicode(1000))
    twitter = db.Column(db.Unicode(1000))
    website = db.Column(db.Unicode(1000))
    image = db.Column(db.LargeBinary)

    def __init__(self, email, firstname=None, lastname=None, date_register=None, bio=None, facebook=None, twitter=None, 
                    website=None, image=None):
        self.email = email
        self.firstname = firstname
        self.lastname = lastname
        self.date_register = time.time()
        self.bio = bio
        self.facebook = facebook
        self.twitter = twitter
        self.website = website
        self.image = image
        self.email = email

    def __repr__(self):
        return '<User %r>' % self.email

### Login Functions ###
def get_user_by_id(id):
    """
    Given a unicode ID, returns the user that matches it.
    """
    return User.query.get(id)

def create_browserid_user(kwargs):
    """
    Takes browserid response and creates a user.
    """
    if kwargs['status'] == 'okay':
        user = User(kwargs['email'])
        db.session.add(user)
        db.session.commit()
        print "create_browserid_user - " + str(type(user)) + " - " + str(user)
        return user
    else:
        return None

def get_user(kwargs):
    """
    Given the response from BrowserID, finds or creates a user.
    If a user can neither be found nor created, returns None.
    """
    u = User.query.filter(db.or_(
        User.id == kwargs.get('id'),
        User.email == kwargs.get('email')
    )).first()
    if u is None: # user didn't exist in db
        return create_browserid_user(kwargs)
    return u

login_manager = LoginManager()
login_manager.user_loader(get_user_by_id)
login_manager.init_app(app)

browserid = BrowserID()
browserid.user_loader(get_user)
browserid.init_app(app)

### Routing ###
@app.route('/')
def home():
    if current_user.is_authenticated():
        return render_template('dashboard.html')
    return render_template('index.html')

@app.route('/editprofile')
def editprofile():
    if current_user.is_authenticated():
        return render_template('editprofile.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

@app.route('/settings')
def settings():
    if current_user.is_authenticated():
        return render_template('settings.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

@app.route('/browse')
def browse():
    if current_user.is_authenticated():
        return render_template('browse.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

@app.route('/votingrecord')
def votingrecord():
    if current_user.is_authenticated():
        return render_template('votingrecord.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

@app.route('/vote')
def vote():
    if current_user.is_authenticated():
        return render_template('vote.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

@app.route('/compatibility')
def compatibility():
    if current_user.is_authenticated():
        return render_template('compatibility.html')
    return render_template('index.html', error="Opps! You've gotta be logged in for that!")

### Admin Tools ###
@app.route('/show_db')
def show_db():
    users = []
    for user in db.session.query(User):
        users.append(dict(id=user.id, email=user.email, fisrtname=user.firstname, lastname=user.lastname, date_register=user.date_register))
    return render_template('show_db.html', users=users)


if __name__ == '__main__':
    app.run()
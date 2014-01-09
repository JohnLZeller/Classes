import sqlite3
from flask import Flask, request, session, g, redirect, url_for, \
     abort, render_template, flash
from contextlib import closing
import time
from flask.ext.login import LoginManager
from flask.ext.browserid import BrowserID
#from my_stuff import get_user_by_id # finds a user by their id
#from other_stuff import get_user # finds a user based on BrowserID response

DATABASE = '/tmp/flaskr.db'
DEBUG = True
SECRET_KEY = 'development key'
USERNAME = 'admin'
PASSWORD = 'default'

app = Flask(__name__)
app.config.from_object(__name__)

login_manager = LoginManager()
login_manager.user_loader(get_user_by_id)
login_manager.init_app(app)

browser_id = BrowserID()
browser_id.user_loader(get_user)
browser_id.init_app(app)

### Flask-Login ###
@login_manager.user_loader
def load_user(userid):
    return User.get(userid)

@app.route("/login", methods=["GET", "POST"])
def login():
    form = LoginForm()
    if form.validate_on_submit():
        # login and validate the user...
        login_user(user)
        flash("Logged in successfully.")
        return redirect(request.args.get("next") or url_for("index"))
    return render_template("login.html", form=form)

### Database Functions ###
def init_db():
    with closing(connect_db()) as db:
        with app.open_resource('schema.sql', mode='r') as f:
            db.cursor().executescript(f.read())
        db.commit()

@app.before_request
def before_request():
    g.db = connect_db()

@app.teardown_request
def teardown_request(exception):
    db = getattr(g, 'db', None)
    if db is not None:
        db.close()

def connect_db():
    return sqlite3.connect(app.config['DATABASE'])

### Routing ###
@app.route('/')
def home():
    if not session.get('logged_in'):
        return render_template('index.html')
    else:
        return render_template('dashboard.html')

### Admin Tools ###
@app.route('/show_db')
def show_db():
    cur = g.db.execute('select email, password from users order by email desc')
    users = [dict(email=row[0], password=row[1]) for row in cur.fetchall()]
    return render_template('show_db.html', users=users)

### Deprecated ###
"""
@app.route('/signup', methods=['GET', 'POST'])
def sign_up():
    if request.method == 'POST':
        values = [request.form['email'], request.form['password'], time.time(), request.form['firstname'] + " " + request.form['lastname'], 
                        None, None, None, None]
        cur = g.db.execute('insert into users (email, password, date_register, bio, facebook, twitter, website, image) values (?, ?, ?, ?, ?, ?, ?, ?)',
                      values)
        g.db.commit()
        flash('Sign up was successful! Please login now.')
        return render_template('login.html', firstname=request.form['firstname'])
    return render_template('signup.html')

@app.route('/account', methods=['GET', 'POST'])
def account_info():
    if request.method == 'POST':
        values = [request.form['email'], request.form['password'], time.time(), request.form['firstname'] + " " + request.form['lastname'], 
                        None, None, None, None]
        cur = g.db.execute('insert into users (email, password, date_register, bio, facebook, twitter, website, image) values (?, ?, ?, ?, ?, ?, ?, ?)',
                      values)
        g.db.commit()
        flash('Sign up was successful! Please login now.')
        return render_template('login.html', firstname=request.form['firstname'])
    return render_template('signup.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
    error = None
    if request.method == 'POST':
        cur = g.db.execute('select email, password from users where email = ?', (request.form['email'], ))
        try:
            email, password = cur.fetchone()
            if request.form['password'] != password:
                error = 'Invalid password'
            else:
                session['logged_in'] = True
                flash('You were logged in')
            return render_template('dashboard.html', error=error)
        except TypeError:
            error = 'Invalid email'
    return render_template('index.html', error=error)

@app.route('/logout')
def logout():
    session.pop('logged_in', None)
    flash('You were logged out')
    return render_template('index.html')
"""

if __name__ == '__main__':
    app.run()

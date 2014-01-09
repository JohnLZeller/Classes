import sqlite3
from flask import Flask, request, session, g, redirect, url_for, \
     abort, render_template, flash
from contextlib import closing
import time

DATABASE = '/tmp/flaskr.db'
DEBUG = True
SECRET_KEY = 'development key'
USERNAME = 'admin'
PASSWORD = 'default'

app = Flask(__name__)
app.config.from_object(__name__)

### Decorators ###
def checkSession(f):
    def new_f():
        if not session.get('logged_in'):
            error = "Opps! You're not logged in!"
            return render_template('index.html', error=error)
        else:
            f()
    return new_f

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

@app.route('/show_db')
def show_db():
    cur = g.db.execute('select email, password from users order by email desc')
    users = [dict(email=row[0], password=row[1]) for row in cur.fetchall()]
    return render_template('show_db.html', users=users)

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
@checkSession
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

@app.route('/add', methods=['POST'])
def add_entry():
    if not session.get('logged_in'):
        abort(401)
    g.db.execute('insert into entries (title, text) values (?, ?)',
                 [request.form['title'], request.form['text']])
    g.db.commit()
    flash('New entry was successfully posted')
    return redirect(url_for('show_entries'))

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

if __name__ == '__main__':
    app.run()
import React from "react";
import './App.css';
import classNames from "classnames";

const wishes = [
    { text: 'Travel tpo the moon', done: false },
    { text: 'Pay the gym', done: true },
    { text: 'Go to the gym', done: false }
]

const App = () =>
    <div className="app">
        <h1>My Whishlist app</h1>
        <fieldset className="wish-input">
            <legend className="wish-input__label">New wish</legend>
            <input className="wish-input__field" placeholder="Enter your wish" />
        </fieldset>
        <ul className="wish-list">
            {wishes.map(({ text, done }, i) => (
                <li key={text} className={`wish-list__item ${done ? 'wish-list__item--done' : ''} `}> 
                                                                                                {/* Eso podria hacerse utilizando la libreria classNames */}
                    <label htmlFor={`wish${i}`}>
                        <input id={`wish${i}`} type="checkbox" checked={done} />
                        {text}
                    </label>
                </li>
            ))}
        </ul>
        <button className="wish-clear" type="button">Archive done</button>
    </div>;

export default App;
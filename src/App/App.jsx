import React from "react";
import './App.css';

const wishes = [
    { text: 'Travel tpo the moon', done: false },
    { text: 'Pay the gym', done: true },
    { text: 'Go to the gym', done: false }
]

const App = () =>
    <div>
        <h1>My Whishlist app</h1>
        <fieldset>
            <legend>New wish</legend>
            <input placeholder="Enter your wish" />
        </fieldset>
        <ul>
            {wishes.map(({ text, done }, i) => (
                <li>
                    <label htmlFor={`wish${i}`}>
                        <input id={`wish${i}`} type="checkbox" checked={done} />
                        {text}
                    </label>
                </li>
            ))}
        </ul>
        <button type="button">Archive done</button>
    </div>;

export default App;
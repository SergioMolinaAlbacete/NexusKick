import React from "react";
import './App.css';

import WishInput from "./WishInput";
import WishList from "./WishList";


const wishes = [
    { text: 'Travel tpo the moon', done: false },
    { text: 'Pay the gym', done: true },
    { text: 'Go to the gym', done: false }
]


const App = () =>
    <div className="app">
        <h1>My Whishlist app</h1>
        <WishInput />
        <WishList wishes={wishes}/>
        <button className="wish-clear" type="button">Archive done</button>
    </div>;

export default App;
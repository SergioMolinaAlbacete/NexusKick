import React, { useState } from "react";
import './App.css';

import WishInput from "./WishInput";
import WishList from "./WishList";


const initialwishes = [
    { text: 'Travel tpo the moon', done: false },
    { text: 'Pay the gym', done: true },
    { text: 'Go to the gym', done: false }
]


const App = () => {
    const [wishes, setWishes] = useState(initialwishes);
    return (
        <div className="app">
            <h1>My Whishlist app</h1>
            <WishInput onNewWish={wish => setWishes([ wish, ...wishes ])} />
            <WishList wishes={wishes} />
            <button className="wish-clear" type="button">Archive done</button>
        </div>
    );
};
export default App;
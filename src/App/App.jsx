import React from "react";
import './App.css';

import WishInput from "./WishInput";
import WishList from "./WishList";


const App = () =>
    <div className="app">
        <h1>My Whishlist app</h1>
        <WishInput />
        <WishList />
        <button className="wish-clear" type="button">Archive done</button>
    </div>;

export default App;
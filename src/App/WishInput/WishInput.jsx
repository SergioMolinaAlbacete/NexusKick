import React, { useState } from "react";
import PropTypes from "prop-types";


const WishInput = ({ onNewWish }) => {
    const [newWishTest, setNewWishText] = useState('');
    return (
        <fieldset className="wish-input">
            <legend className="wish-input__label">New wish</legend>
            <input className="wish-input__field" placeholder="Enter your wish" value={newWishTest} 
            onChange={e => setNewWishText(e.target.value)}
            onKeyUp={e => {
                if(e.key === 'Enter' && newWishTest.length){
                    onNewWish({done: false, text: newWishTest})
                    setNewWishText('');
                }
            }} />
        </fieldset>
    );
};

WishInput.PropTypes = {
    onNewWish: PropTypes.func,
}

WishInput.defaultProp = {
    onNewWish: () => { },
}

export default WishInput;
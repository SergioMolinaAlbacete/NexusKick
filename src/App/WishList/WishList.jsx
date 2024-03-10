import React from "react";

const wishes = [
    { text: 'Travel tpo the moon', done: false },
    { text: 'Pay the gym', done: true },
    { text: 'Go to the gym', done: false }
]

const WishList = ({wishes}) => (
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
);

export default WishList;
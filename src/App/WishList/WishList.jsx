import React from "react";
import PropTypes from "prop-types";

const WishList = ({ wishes }) => (
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

WishList.PropTypes = {
    wishes: PropTypes.arrayOf(
        PropTypes.shape({
            done: PropTypes.bool,
            text: PropTypes.string,
        })),
};

WishList.defaultProps = {
    wishes: [],
}

export default WishList;
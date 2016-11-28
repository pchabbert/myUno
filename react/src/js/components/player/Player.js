import React from 'react';

import Card from '../card/Card'

export default class Player extends React.Component {
  render () {
    const name = 'Player 2';

    const containerStyle = {
      border: "1px solid",
      padding: "5px"
    };

    return (
      <div className="player" style={containerStyle}>
        <span>Player name : {name}</span>
        <Card/>
      </div>
    );
  }
}


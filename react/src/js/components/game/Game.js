import React from 'react';

import DrawPile from './DrawPile';
import DiscardPile from './DiscardPile';
import Player from '../player/Player';

export default class Game extends React.Component {
  constructor() {
    super();
    this.state = {

    }
  }
  render() {
    return (
      <div id="game">
        <span>Game</span>
        <DiscardPile/>
        <DrawPile/>
        <Player/>
      </div>
    );
  }
}


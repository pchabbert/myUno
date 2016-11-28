import React from 'react';

import Header from './Header';
import Footer from './Footer';

import Game from './game/Game';

export default class Layout extends React.Component {
  render() {
    return (
      <div>
        <Header/>
        <Game/>
        <Footer/>
      </div>
    );
  }
}


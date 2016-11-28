import React from 'react';

export default class Card extends React.Component {


  play (number, color) {
    console.log(number, color)
  }

  render () {
    const number = 1;
    const color = 'red';

    const containerStyle = {
      border: "0.5px solid",
      backgroundColor: color,
      margin: "10px",
      padding: "5px",
      width: "100px"
    };

    return (
      <div class="card" style={containerStyle}>
        <span>Number: {number}</span>
        <br/>
        <span>Color: {color}</span>
      </div>
    );
  }
}


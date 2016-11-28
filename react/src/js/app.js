import {applyMiddleware, createStore} from 'redux';
import logger from 'redux-logger';
import thunk from 'redux-thunk';
import axios from 'axios';
import promise from 'redux-promise-middleware';

import React from 'react';
import ReactDom from 'react-dom';

import Layout from './components/Layout.js'

const initialState = {
  fetching: false,
  fetched: false,
  game: {},
  error: null
};

const reducer = (state = initialState, action) => {
  switch(action.type) {
    case "FETCH_GAME_PENDING":
      return {
        ...state,
        fetching: true
      };
      break;
    case "FETCH_GAME_FULFILLED":
      return {
        ...state,
        fetching: false,
        fetched: true,
        game: action.payload.data
      };
      break;
    case 'FETCH_GAME_REJECTED':
      return {
        ...state,
        fetching: false,
        error: action.payload
      };
      break;
  }

  return state;
};

const middleware = applyMiddleware(promise(), thunk, logger());
const store = createStore(reducer, middleware);

store.dispatch({
  type: "FETCH_GAME",
  payload: axios.get('http://127.0.0.1:8000/game/create')
});


ReactDom.render(<Layout/>, document.getElementById('app'));
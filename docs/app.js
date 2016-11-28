import React from 'react';
import ReactDom from 'react-dom';
import { applyMiddleware, combineReducers, createStore } from 'redux';

import Layout from './components/Layout.js'

const userReducer = (state = {}, action) => {
  switch(action.type) {
    case 'CHANGE_NAME':
      state = {
        ...state,
        name: action.paylaod
      };
      break;

    case 'CHANGE_AGE':
      state = {
        ...state,
        age: action.paylaod
      };
      break;

    case 'E':
      throw new Error('User Reducer Error');
      break;
  }

  return state;
};

const tweetsReducer = (state = [], action) => {
  return state;
};

const reducers = combineReducers({
  user: userReducer,
  tweets: tweetsReducer

});

const error = (state) => (next) => (action) => {
  try {
    next(action);
  } catch (e) {
    console.log('[ERROR]', e);
  }
};

const store = createStore(reducers, applyMiddleware(error));

store.subscribe(() => {
  console.log('store changed', store.getState());
});

store.dispatch({
  type: 'CHANGE_NAME',
  paylaod: "Phil"
});
store.dispatch({
  type: 'E',
  paylaod: 35
});

ReactDom.render(<Layout/>, document.getElementById('app'));
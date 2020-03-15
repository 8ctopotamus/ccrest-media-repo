import React from 'react'
import { MdClose, MdShoppingCart } from 'react-icons/md'
import AppContext from '../../context'

export default () => (
  <AppContext.Consumer>
      {({state, dispatch}) => {
        const isCartView = state.view === 'CART'
        const targetView = isCartView
          ? null
          : 'CART'
        return (
          <div
            className="cart-count" 
            onClick={() => dispatch({
              type: 'SET_VIEW',
              payload: targetView
            })}
          >
            {isCartView
              ? (
                <>
                  <MdClose size="25" /> 
                  <span>Keep browsing</span>
                </>
              ) : (
                <>
                  <MdShoppingCart size="25" /> 
                  <span>{state.cart.length}</span>
                </>
              )}
          </div>
        )
      }}
  </AppContext.Consumer>
)
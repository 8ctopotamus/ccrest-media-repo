import React, { 
  useContext,
  useReducer,
  useEffect,
} from 'react'

import AppContext from './index'
import appReducer from './reducer'

export default ({children}) => {
  const initialState = useContext(AppContext)
  const [state, dispatch] = useReducer(appReducer, initialState)

  useEffect(() => dispatch({
    type: 'GET_LOCALSTORAGE',
  }), [])

  return (
    <AppContext.Provider value={{state, dispatch}}>
      { children }
    </AppContext.Provider>
  )
}

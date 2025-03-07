import React from 'react'
import { Provider } from "./components/ui/provider"
import ReactDOM from 'react-dom/client'
import App from './App'
import { useColorMode } from "./components/ui/color-mode"
import 'bootstrap/dist/css/bootstrap.css'

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <Provider>
      <App />
    </Provider>

  </React.StrictMode>,
)

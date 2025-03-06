import ListGroup from "./components/ListGroup";
import Alert from "./components/Alert";
import Button from "./components/Button";
import DismissAlert from "./components/DismissAlert";
import { useState } from "react";
import { FaRegHeart } from "react-icons/fa";
import Like from "./components/Like";



function App() {
  // let items = ["New York", "San Fransisco", "Tokyo", "London", "Paris"];

  // const handleSelectItem = (item: string) => {
  //   console.log(item);
  // }

  // return <div><ListGroup items={items} heading="Cities" onSelectItem={handleSelectItem} /></div>

  return <div><Like onClick={() => console.log("clicked")}/></div>


  // return (
  //   <div>
  //     <Alert>
  //       Hello<span> World</span> 
  //     </Alert>
  //   </div>
  // );



  // return (
  //   <div>
  //     <Button title="Click Me!" color="danger" onClick={() => console.log("Clicked!")}/>
  //   </div>
  // );

  // const [alertVisible, setAlertVisibility] = useState(false);




  // return (
  //   <div>
  //     {alertVisible && <Alert onClose={() => setAlertVisibility(false)}><strong>Holy guacamole!</strong> You should check in on some of those fields below. </Alert>}
  //     <Button title="Click Me!" color="primary" onClick={() => setAlertVisibility(true)}/>
  //   </div>
  // );
}



export default App;
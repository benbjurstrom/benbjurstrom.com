import { PDFObject } from 'react-pdfobject'

const Pdf = ({url}: { url: string }): JSX.Element => {
  return (
    <PDFObject
      width="100%"
      height="600px"
      url={url}
      pdfOpenParams={{
        zoom: 'scale',
        pagemode: 'none',
        view: 'Fit',
      }}
    />
  )
}

export default Pdf
